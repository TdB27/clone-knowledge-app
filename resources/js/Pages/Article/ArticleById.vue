<template>
    <div class="article-by-id">
        <Layout>
            <PageTitle
                icon="fa fa-file-o"
                :main="article.name"
                :sub="article.description"
            />
            <div class="article-content" v-html="article.content"></div>
        </Layout>
    </div>
</template>

<script>
import Layout from "@/layouts/Layout.vue";
import PageTitle from "@/layouts/PageTitle.vue";

import "highlightjs/styles/monokai.css";
import hljs from "highlightjs/highlight.pack.js";

export default {
    name: "ArticleById",
    components: { Layout, PageTitle },
    props: { article: Object },
    mounted() {
        document.querySelectorAll(".article-content pre").forEach((e) => {
            hljs.highlightBlock(e);
        });
    },
};
</script>

<style>
.article-content {
    background-color: #fff;
    border-radius: 8px;
    padding: 25px;
}
.article-content pre {
    padding: 20px;
    border-radius: 8px;
    font-size: 1.2rem;
    background-color: #1e1e1e;
    color: #fff;
}

.article-content img {
    max-width: 100%;
}

.article-content :last-child {
    margin-bottom: 0;
}
</style>
