<template>
  <div>
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div>
        <button class="btn btn-light" :class="{ 'is-active': isActive.bold() }" @click="commands.bold"><b>F</b></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.italic() }" @click="commands.italic"><i>K</i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.underline() }" @click="commands.underline"><u>U</u></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.strike() }" @click="commands.strike"><s>abc</s></button>
        <button class="btn btn-light" ><i class="fas fa-undo"></i></button>
      </div>
    </editor-menu-bar>
    <editor-content class="editor__content" :editor="editor" style="border: 1px solid #ced4da; border-radius: 4px; padding: 5px"></editor-content>
  </div>
</template>

<script>
// Import the editor
import { Editor, EditorContent, EditorMenuBar } from 'tiptap';
import { CodeBlock, HardBreak, Heading, HorizontalRule, OrderedList, BulletList, ListItem, TodoItem, TodoList, Bold, Code, Italic, Link, Strike,
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
    }
  },

  watch: {
    eingabeContent: function(){
      this.editor.setContent(this.eingabeContent);
    }
  },

  methods: {

  },

  mounted() {
      this.editor = new Editor({
        extensions: [
          new Bold(),
          new Heading({ levels: [ 1, 2, 3] }),
          new Italic(),
          new Strike(),
          new Underline()
        ],
        content: '',
        onUpdate: ({ getHTML }) => {
          let newContent = getHTML();
          console.log(newContent);
        },
      });
  },
  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>