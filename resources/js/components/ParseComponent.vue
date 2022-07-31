<template>
    <div class="links">
        <a v-bind:href="url_1">Category</a>
        <a v-bind:href="url_2">Manufacturer</a>
        <a v-bind:href="url_3">Product</a>
        <a v-bind:href="url_4">Subcategory</a>
    </div>
</template>

<script>
	export default {
	    data() {
	        return {
	            url_1: '/parse/category',
	            url_2: '/parse/manufacturer',
	            url_3: '/parse/product',
	            url_4: '/parse/subcategory'
	        }
	    }
	};
</script>