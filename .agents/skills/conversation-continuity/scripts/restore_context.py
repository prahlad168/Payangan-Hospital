#!/usr/bin/env python3
"""
Restore Context Script

Parses conversation text or summary to extract key context for resuming work.
Usage:
    python restore_context.py --input "conversation text here"
    python restore_context.py --file path/to/conversation.txt
"""

import argparse
import re
import sys
from pathlib import Path


def extract_key_info(text: str) -> dict:
    """Extract key information from conversation text."""
    
    # Extract file paths mentioned
    file_pattern = r'(?:file|files|path|filepath)[:\s]+([^\s]+\.[a-zA-Z]+)'
    files = re.findall(r'[\w/._-]+\.[a-zA-Z]+', text)
    files = [f for f in files if not f.startswith('http')]
    
    # Extract task keywords
    task_keywords = ['implement', 'create', 'edit', 'fix', 'update', 'build', 
                     'add', 'remove', 'delete', 'modify', 'debug', 'test']
    
    # Extract code patterns (for detecting what was being coded)
    code_blocks = re.findall(r'```[\s\S]*?```', text)
    
    # Extract error messages
    errors = re.findall(r'(?:Error|error|Exception|exception)[:\s]+([^\n]+)', text)
    
    # Extract commands mentioned
    commands = re.findall(r'`([^`]+)`', text)
    
    return {
        'files_mentioned': list(set(files))[:10],  # Limit to 10
        'code_blocks_count': len(code_blocks),
        'errors': errors[:5],
        'commands': list(set(commands))[:10],
        'original_text': text[:500]  # First 500 chars as reference
    }


def generate_summary(info: dict) -> str:
    """Generate a summary from extracted information."""
    
    lines = []
    lines.append("## Context Restoration Summary\n")
    
    if info['files_mentioned']:
        lines.append("### Files Being Worked On:")
        for f in info['files_mentioned']:
            lines.append(f"  - {f}")
        lines.append("")
    
    if info['errors']:
        lines.append("### Errors/Issues:")
        for e in info['errors']:
            lines.append(f"  - {e}")
        lines.append("")
    
    if info['commands']:
        lines.append("### Commands to Run:")
        for c in info['commands']:
            lines.append(f"  - `{c}`")
        lines.append("")
    
    lines.append(f"### Original Context (truncated):")
    lines.append(f"```\n{info['original_text'][:300]}...\n```")
    
    return "\n".join(lines)


def save_to_agents_md(summary: str, agents_path: str = "AGENTS.md"):
    """Save summary to AGENTS.md for persistence."""
    
    try:
        with open(agents_path, 'a', encoding='utf-8') as f:
            f.write(f"\n\n---\n## Session Restore Point ({__import__('datetime').date.today()})\n")
            f.write(summary)
        return True
    except Exception as e:
        print(f"Warning: Could not save to AGENTS.md: {e}")
        return False


def main():
    parser = argparse.ArgumentParser(description='Restore context from conversation text')
    parser.add_argument('--input', '-i', help='Input text directly')
    parser.add_argument('--file', '-f', help='Input file path')
    parser.add_argument('--save', '-s', action='store_true', help='Save to AGENTS.md')
    parser.add_argument('--agents-path', default='AGENTS.md', help='Path to AGENTS.md')
    
    args = parser.parse_args()
    
    # Get input text
    if args.input:
        text = args.input
    elif args.file:
        path = Path(args.file)
        if not path.exists():
            print(f"Error: File not found: {args.file}")
            sys.exit(1)
        text = path.read_text(encoding='utf-8')
    else:
        print("Error: Provide --input or --file")
        sys.exit(1)
    
    # Extract and summarize
    info = extract_key_info(text)
    summary = generate_summary(info)
    
    print(summary)
    
    # Optionally save to AGENTS.md
    if args.save:
        if save_to_agents_md(summary, args.agents_path):
            print(f"\n✓ Saved to {args.agents_path}")
        else:
            print(f"\n✗ Could not save to {args.agents_path}")


if __name__ == '__main__':
    main()
