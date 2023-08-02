<script setup>
const props = defineProps(['item'])

const show = ref([])
async function getData() {

  try{
    const { data } = await useFetch("https://accounting.classtechbd.com/api/Note.php?action=get")
    if(!data.value){
      console.log('failed to get')
    }else {
      show.value = data.value.message
      console.log(show.value)
    }
  } catch(error) {
    console.log(error)
  }

}

getData()

watch(() => props.item,
  val => {
    getData()
  }
)
</script>
<template>
  <div class="container">
    <h1>Note List</h1>
    <ol>
      <li v-for="title in show" :key="title.id">
        {{ title.title }}
      </li>
    </ol>
  </div>
</template>

<style scoped>

.container{
  width: 90%;
  /* background: #ddd; */
  box-shadow: 0px 0px 5px gray;
  border-radius: 12px;
  margin: auto;
  padding: auto 5px;
  padding-left: 15px;
  padding-bottom: 20px;

}
h1{
  font-size: 50px;
  text-align: center;
}

ol {
	padding: 20px;
	/* margin: auto 15px; */
	/* max-width: 700px; */
  width: 90%;
	position: relative;
  /* margin-left: 20px; */
  margin: auto;
  padding-bottom: 20px;
}

ol::before {
	content: '';
	width: 0.5rem;
	height: 100%;
	position: absolute;
	top: 0;
	left: 8%;
	background: peachpuff;
	z-index: -1;
}

li {
	padding: 0.5rem 1.5rem 1rem;
	border-radius: 1.5rem;
	background: peachpuff;
  font-size: 20px;
}

li + li {
	margin-top: 1rem;
}

::marker {
	font-weight: 600;
	color: tomato;
	font-size: 1.8rem;
}




</style>