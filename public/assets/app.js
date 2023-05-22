const { createApp } = Vue;

createApp({
  data() {
    return {
      type: 1,
      attributes: [],
    };
  },
  created() {
    this.switchType();
  },
  methods: {
    switchType() {
      fetch(`/api/type-attributes?type_id=${this.type}`)
        .then((res) => res.text())
        .then((data) => {
          this.attributes = JSON.parse(data);
        });
    },
  },
}).mount("#app");
