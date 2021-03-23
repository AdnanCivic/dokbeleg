import { Node } from 'tiptap'
import { wrappingInputRule, toggleWrap } from 'tiptap-commands'

export default class Jump extends Node {
    get name(){
        return 'jump';
    }

    get schema() {
        return {
          content: 'block*',
          group: 'block',
          defining: true,
          draggable: false,
          parseDOM: [
            { tag: 'blockquote' },
          ],
          toDOM: () => ['blockquote', 0],
        }
      }
    
      commands({ type }) {
        return () => toggleWrap(type)
      }
    
      keys({ type }) {
        return {
          'Ctrl->': toggleWrap(type),
        }
      }
    
      inputRules({ type }) {
        return [
          wrappingInputRule(/^\s*>\s$/, type),
        ]
      }
}