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
        Titre : {{ post.title }}
        Markdown : {{ post.description }}
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
