<template>
  <div>
    <div class="flex justify-between">
      <jet-button @click.native="goPrevious()" type="button" v-if="posts.current_page > 1">
          Page précédente
      </jet-button>

      <jet-button @click.native="goNext()" type="button" v-if="posts.current_page < posts.last_page">
          Page suivante
      </jet-button>
    </div>

    <div v-for="post in posts.data" :key="post.id">
        ID : {{ post.id }}
        <br>
        Publié le : {{ post.published_at | moment("dddd Do MMMM") }}
        <br>
        Titre : {{ post.title }}
        <br>
        Markdown :
        <vue-showdown class="markdown-text" :markdown="post.description" tag="span"/>
    </div>
  </div>
</template>

<script>
import JetButton from './../Jetstream/Button'

export default {
  components: {
    JetButton,
  },

  props: {
    posts: {
      type: Object,
      required: true
    }
  },

  methods: {
    goNext() {
        this.$inertia.visit('/services', {
            data: {
                page: this.posts.current_page + 1,
            },
            preserveScroll: true,
        });
    },

    goPrevious() {
        this.$inertia.visit('/services', {
            data: {
                page: this.posts.current_page - 1,
            },
            preserveScroll: true,
        });
    },
  }
}
</script>

<style>
/* .markdown-text ol {
  @apply list-decimal;
  @apply list-inside;
}
.markdown-text ul {
  @apply list-disc;
  @apply list-inside;
}
.markdown-text hr {
  border-color: #eee;
}
.markdown-text blockquote {
  margin: 30px auto;
  font-style: italic;
  padding: 1.5em;
  border-left: 8px solid #f6bc24;
  line-height: 1.6;
  position: relative;
  background: #f7f7f7;
}
.markdown-text pre {
  background: #f7f7f7;
  padding: 1.5em;
  font-size: 0.8em;
}
.markdown-text h1 {
  @apply text-3xl;
  @apply font-bold;
  @apply text-orange;
}
.markdown-text h2 {
  @apply text-2xl;
  @apply font-medium;
}
.markdown-text h3 {
  @apply text-xl;
  @apply font-medium;
}
.markdown-text h4 {
  @apply text-lg;
  @apply font-medium;
}
.markdown-text h5 {
  @apply text-lg;
} */
</style>
