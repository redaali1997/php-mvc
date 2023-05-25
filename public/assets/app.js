const { createApp } = Vue;

createApp({
  data() {
    return {
      type: type,
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
