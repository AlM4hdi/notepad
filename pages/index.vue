<template>
  <div class="contaier">

    <h1>NOTEPAD</h1>

    <AddItem @somedata="updateItem"/> 


    <ShowItem :item="item" @item-updated="updateItem" />
    <div class="spacer">

    </div>
  </div>
</template>

<script setup>


const item = ref(false);

const updateItem = () => {
  item.value = !item.value;
};
</script>

<style scoped>
container{
  background-color: #000;
}

h1{
  text-align: center;
  color: greenyellow;
}


.spacer{
  height: 100px;
}
</style>