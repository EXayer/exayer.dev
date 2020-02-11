<template>
  <nav class="px-8 pt-4">
    <div class="relative w-48 ml-auto">
      <button
        class="relative z-10 block focus:outline-none focus:border-white ml-auto mr-0"
        @click="isOpen = !isOpen"
      >
        <span class="flex items-center">
          <span class="text-base">{{ username }}</span> <i class="material-icons">arrow_drop_down</i>
        </span>
      </button>
      <button
        v-if="isOpen"
        tabindex="-1"
        class="fixed inset-0 h-full w-full cursor-default"
        @click="isOpen = false"
      />
      <div
        v-if="isOpen"
        class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-lg shadow-xl"
      >
        <a
          href="#"
          class="block px-4 py-2 hover:bg-gray-200"
        >Profile</a>
        <a
          href="/index.php/logout"
          class="block px-4 py-2 hover:bg-gray-200"
        >Sign out</a>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",

  props: {
    userName: {
      type: String,
      default: 'Admin',
      useDefaultForNull: true
    }
  },

  data: function () {
    return {
      username: this.userName,
      isOpen: false
    }
  },

  created () {
    const handleEscape = (e) => {
      if (e.key === 'Esc' || e.key === 'Escape') {
        this.isOpen = false
      }
    };

    document.addEventListener('keydown', handleEscape);

    this.$once('hook:beforeDestroy', () => {
      document.removeEventListener('keydown', handleEscape)
    })
  }
}
</script>

<style scoped>

</style>

