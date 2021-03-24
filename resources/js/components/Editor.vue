<template>
  <div>
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.bold() }" @click.prevent="commands.bold"><i class="fas fa-bold"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.italic() }" @click.prevent="commands.italic"><i class="fas fa-italic"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.underline() }" @click.prevent="commands.underline"><i class="fas fa-underline"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.strike() }" @click.prevent="commands.strike"><i class="fas fa-strikethrough"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.heading({level: 2}) }" @click.prevent="commands.heading({level:2})"><i class="fa fa-header">H2</i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.heading({level: 3}) }" @click.prevent="commands.heading({level:3})"><i class="fa fa-header">H3</i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.bullet_list() }" @click.prevent="commands.bullet_list"><i class="fa fa-list"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.ordered_list() }" @click.prevent="commands.ordered_list"><i class="fa fa-list-ol"></i></button>
        <button type="button" class="btn btn-light" @click.prevent="commands.horizontal_rule"><i>-</i></button>
        <button type="button" class="btn btn-light" @click.prevent="commands.undo"><i class="fa fa-undo" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-light" @click.prevent="commands.redo"><i class="fa fa-redo" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-light" :class="{ 'is-active': isActive.code() }" @click.prevent="commands.code"><i class="fas fa-marker"></i></button>
        <button type="button" class="btn btn-light" @click.prevent="jumpToMarker"><i class="fas fa-compress-arrows-alt"></i></button>
      </div>
    </editor-menu-bar>
    <editor-content :editor="editor" class="editor"></editor-content>
  </div>
</template>

<script>
// Import the editor
import { Editor, EditorContent, EditorMenuBar } from 'tiptap';
import { Bold, Italic, Underline, Strike, Heading, BulletList, OrderedList, ListItem, HorizontalRule, History, Image, Code } from 'tiptap-extensions';
import Jump from './Jump.js';

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
      updatedContent: '',
      codeSelection: null
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
          new HorizontalRule(), new History(), new Image(), new Code(), new Jump()
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

<style scoped>

.editor {
  border: 1px solid #ced4da;
  border-radius: 4px; padding: 5px; 
  min-height: 300px;
}

</style>