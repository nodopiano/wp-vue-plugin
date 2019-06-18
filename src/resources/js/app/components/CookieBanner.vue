<template>
  <div v-if="showBanner" class="np-cookie-banner" :class="`np-cookie-banner--${options.enter_from} ${scrollInClass}`"  :style="bannerStyle">
    <div class="np-cookie-banner__wrapper">
      <div class="np-cookie-banner__text" v-html="options.text" />
      <div class="np-cookie-banner__controls">
        <button class="np-cookie-banner__controls__accept" :style="acceptStyle" @click="acceptCookies()">{{ options.accept_text }}</button>
        <button class="np-cookie-banner__controls__refuse" :style="rejectStyle" @click="rejectCookies()">{{ options.reject_text }}</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  filters: {
    enterFrom: function(value) {
      return value === 'top' ? 'Alto' : 'Basso'
    }
  },

  props: {
    options: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      showBanner: true,
      scrollInClass: ''
    }
  },

  computed: {
    bannerStyle() {
      return `background-color: ${this.options.banner_bg};`
    },
    acceptStyle() {
      return `background-color: ${this.options.accept_bg}; color: ${this.options.accept_color};`
    },
    rejectStyle() {
      return `background-color: ${this.options.reject_bg}; color: ${this.options.reject_color};`
    }
  },

  mounted() {
    this.showBanner = !this.$cookieSolution.isAccepted()
    setTimeout(() => {
      this.scrollInClass = 'np-cookie-banner--scroll-in'
    }, 500)
  },

  methods: {
    acceptCookies: function() {
      this.$cookieSolution.accept()
      this.scrollInClass = ''
      location.reload()
    },
    rejectCookies: function() {
      this.scrollInClass = ''
    }
  }
}
</script>

