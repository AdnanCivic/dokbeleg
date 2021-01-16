<template>
  <div>
    <editor-menu-bar/>
    <editor-content class="editor__content" :editor="editor" style="border: 1px solid; border-radius: 4px; padding: 5px"/>
    <button type="button" @click="setC">einfügen</button>
  </div>
</template>

<script>
// Import the editor
import { Editor, EditorContent, EditorMenuBar } from 'tiptap';
import {
  Blockquote,
  CodeBlock,
  HardBreak,
  Heading,
  HorizontalRule,
  OrderedList,
  BulletList,
  ListItem,
  TodoItem,
  TodoList,
  Bold,
  Code,
  Italic,
  Link,
  Strike,
  Underline,
  History,
  TrailingNode,
} from 'tiptap-extensions'

export default {
  props: {
    eingabeContent: {
      type: String,
      required: false
    }
  },
  components: {
    EditorContent,
    EditorMenuBar,
  },
  data() {
    return {
      editor: null,
    }
  },
  methods: {
    setC(){
      this.editor.setContent(this.eingabeContent);
    }
  },

  mounted() {
    this.editor = new Editor({
      content: '<p>Hacker Pschorr</p>',
    });
    
  },
  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>