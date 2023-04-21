<template>
    <div class="content">
        <slot />
    </div>
</template>

<script>
export default {
    name: "ContentLayout",
};
</script>

<style scoped>
.content {
    grid-area: content;
    background-color: #efefef;
    padding: 20px;
}
</style>
