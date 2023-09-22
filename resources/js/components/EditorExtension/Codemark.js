import { Mark } from 'tiptap'
import { toggleMark, markInputRule, markPasteRule } from 'tiptap-commands'

export default class Codemark extends Mark {

  get name() {
    return 'codemark'
  }

  get schema() {
    return {
      attrs: {
        id: {
          default: ''
        }
      },
      excludes: '_',
      parseDOM: [{
        tag: 'code' ,
        getAttrs: dom => ({
          id: dom.getAttribute('id')
        }),
      }],
      toDOM: (node) => ['code', {
        class: 'codemark',
        id: node.attrs.id || this.createId() 
      }, 0],
    }
  }

  keys({ type }) {
    return {
      'Mod-`': toggleMark(type),
    }
  }

  commands({ type }) {
    return () => toggleMark(type)
  }

  inputRules({ type }) {
    return [
      markInputRule(/(?:`)([^`]+)(?:`)$/, type),
    ]
  }

  pasteRules({ type }) {
    return [
      markPasteRule(/(?:`)([^`]+)(?:`)/g, type),
    ]
  }

  createId (length = 3) {
    return Math.round((Math.pow(36, length + 1) - Math.random() * Math.pow(36, length))).toString(36).slice(1)
  }

}
