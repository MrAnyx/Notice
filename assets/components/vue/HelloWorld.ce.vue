<template>
   <h1>Hello {{ name }}</h1>
</template>

<script>
export default {
   props: {
      name: {
         type: String,
         required: false,
         default: "World",
      },
   },
};
</script>

<style lang="scss" scoped>
h1 {
   color: red;
   &:hover {
      color: blue;
   }
}
</style>
