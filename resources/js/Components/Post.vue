<template>
  <div class="my-6 mx-20">
    <div class="font-bold text-xl uppercase" v-if="displayTitle">
      {{ post.title }}
    </div>

    <div class="text-gray-400 italic" v-if="displayPublicationDate">
     {{ post.published_at | moment("dddd Do MMMM") }}
    </div>

    <div class="mt-2 mb-8">
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
