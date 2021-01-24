<template>
  <div>
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div>
        <button class="btn btn-light" :class="{ 'is-active': isActive.bold() }" @click="commands.bold"><i class="fas fa-bold"></i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.italic() }" @click="commands.italic"><i class="fas fa-italic"></i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.underline() }" @click="commands.underline"><i class="fas fa-underline"></i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.strike() }" @click="commands.strike"><i class="fas fa-strikethrough"></i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.heading({level: 2}) }" @click="commands.heading({level:2})"><i class="fa fa-header">H2</i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.heading({level: 3}) }" @click="commands.heading({level:3})"><i class="fa fa-header">H3</i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.bullet_list() }" @click="commands.bullet_list"><i class="fa fa-list"></i></button>
        <button class="btn btn-light" :class="{ 'is-active': isActive.ordered_list() }" @click="commands.ordered_list"><i class="fa fa-list-ol"></i></button>
        <button class="btn btn-light" @click="commands.horizontal_rule"><i>-</i></button>
        <button class="btn btn-light" @click="commands.undo"><i class="fa fa-undo" aria-hidden="true"></i></button>
        <button class="btn btn-light" @click="commands.redo"><i class="fa fa-redo" aria-hidden="true"></i></button>
      </div>
    </editor-menu-bar>
    <editor-content :editor="editor" style="border: 1px solid #ced4da; border-radius: 4px; padding: 5px"></editor-content>
  </div>
</template>

<script>
// Import the editor
import { Editor, EditorContent, EditorMenuBar } from 'tiptap';
import { Bold, Italic, Underline, Strike, Heading, BulletList, OrderedList, ListItem, HorizontalRule, History } from 'tiptap-extensions';

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
      updatedContent: ''
    }
  },

  watch: {
    eingabeContent: function(){
      let html = this.editor.getHTML();
      if (html !== this.eingabeContent) {
        this.editor.setContent(this.eingabeContent);
      }
    }
  },

  methods: {

  },

  mounted() {
      this.editor = new Editor({
        extensions: [
          new Bold(), new Italic(), new Underline(), new Strike(),
          new BulletList(), new OrderedList(), new ListItem(), new Heading({ levels: [1, 2, 3] }),
          new HorizontalRule(), new History(),
        ],
        
        onUpdate: ({ getHTML }) => {
          this.updatedContent = getHTML();
          this.$emit('contentUpdated', this.updatedContent); 
        },
      });
  },
  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>