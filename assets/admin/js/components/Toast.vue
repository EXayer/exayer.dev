<template>
  <div
    v-if="show"
    class="border-t-4 rounded-b px-4 py-3 mt-2 shadow-md"
    :class="color"
    role="alert"
    @click="show=false"
  >
    <div class="flex">
      <div class="py-2 pr-2">
        <i class="material-icons">{{ icons[type] }}</i>
      </div>
      <div>
        <p class="font-bold">
          {{ type }}
        </p>
        <p class="text-sm">
          {{ message }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Toast",

  props: {
    type: {
      type: String,
      default: 'notice',
      useDefaultForNull: true
    },
    message: {
      type: String,
      default: '',
      useDefaultForNull: true
    }
  },

  data: function () {
    return {
      icons: {
        notice: 'info',
        warning: 'warning',
        error: 'error'
      },
      show: true
    }
  },

  computed: {
    color: function () {
      return {
        'bg-teal-100': this.type === 'notice',
        'border-teal-500': this.type === 'notice',
        'text-teal-900': this.type === 'notice',
        'bg-yellow-100': this.type === 'warning',
        'border-yellow-500': this.type === 'warning',
        'text-yellow-900': this.type === 'warning',
        'bg-red-100': this.type === 'error',
        'border-red-500': this.type === 'error',
        'text-red-900': this.type === 'error',
      }
    }
  },

  mounted(){
    this.hide();
  },

  methods: {
    hide() {
      setTimeout(() => { this.show = false; }, 5000);
    }
  }
}
</script>

<style scoped>

</style>