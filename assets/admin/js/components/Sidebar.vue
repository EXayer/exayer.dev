<template>
  <nav class="sidebar">
    <header class="my-5 text-center text-2xl text-teal-500">
      <a href="/admin/dashboard">EXayer.dev</a>
    </header>

    <ul class="nav">
      <li
        v-for="(item, index) in links"
        :key="index"
        class="headerLink hover:bg-gray-200 font-light"
      >
        <a
          :href="item.link"
          class="sidebar-link text-lg block py-3 px-4"
          :class="{ 'text-yellow-600': item.active }"
        ><span class="icon"><i class="material-icons text-lg">{{ item.icon }}</i></span> {{ item.label }}</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Sidebar",

  data: function () {
    return {
      links: [
        {
          link: '/dashboard',
          icon: 'dashboard',
          label: 'Dashboard'
        },
        {
          link: '/tag',
          icon: 'label',
          label: 'Tags'
        }
      ]
    }
  },

  created() {
    this.setActive();
  },

  methods: {
    setActive() {
      const page = '/' +  location.pathname.split('/')[3]; // TODO: [2] for prod

      for (let i = 0; i < this.links.length; i++) {
        this.links[i].active = page === this.links[i].link;
        this.links[i].link = '/index.php/admin' + this.links[i].link; // TODO: remove index.php/ for prod
      }
    }
  }
}
</script>

<style scoped>

</style>