<template>
    <div class="links">
        <a v-bind:href="url_1">Parsing</a>
        <a v-bind:href="url_2">Configurations</a>
        <a v-bind:href="url_3">Logs</a>
        <a v-bind:href="url_4">Statistics</a>
    </div>
</template>

<script>
	export default {
	    data() {
	        return {
	            url_1: '/parse',
	            url_2: '/configurations',
	            url_3: '/logs',
	            url_4: '/statistics'
	        }
	    }
	};
</script>