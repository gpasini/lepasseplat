<template>
  <div>
    <div v-if="displayPublicationDate">
      Publié le : {{ post.published_at | moment("dddd Do MMMM") }}
    </div>

    <div v-if="displayTitle">
      Titre : {{ post.title }}
    </div>

    <div>
      Markdown :
      <vue-showdown class="markdown-text" :markdown="post.description" tag="span"/>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: {
      type: Object,
      required: true
    },

    displayTitle: {
      type: Boolean,
      default: true,
    },

    displayPublicationDate: {
      type: Boolean,
      default: true,
    },
  }
}
</script>
