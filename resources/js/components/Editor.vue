<template>
  <div>
    <editor-menu-bar>
    </editor-menu-bar>
    <editor-content v-if="this.eingabeContent" class="editor__content" :editor="editor" style="border: 1px solid; border-radius: 4px; padding: 5px"></editor-content>
  </div>
</template>

<script>
// Import the editor
import { Editor, EditorContent, EditorMenuBar } from 'tiptap';
import { Blockquote, CodeBlock, HardBreak, Heading, HorizontalRule, OrderedList, BulletList, ListItem, TodoItem, TodoList, Bold, Code, Italic, Link, Strike,
  Underline, History, TrailingNode } from 'tiptap-extensions';

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
      content: null,
    }
  },

  watch: {
    eingabeContent: function(){
      this.editor.setContent(this.eingabeContent);
    }
  },

  methods: {
    setC(){
      this.editor.setC
    }

  },

  mounted() {
      this.editor = new Editor({
      extensions: [
        new Bold(),
        new Italic(),
        new Strike(),
        new Underline()
      ],
      content: 'Default',
      // onUpdate: ({ getHTML }) => {
      //   let content = getHTML();
      //   console.log(content);
      // },
      });
  },
  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>