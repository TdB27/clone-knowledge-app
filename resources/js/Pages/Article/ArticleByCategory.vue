<template>
    <div class="articles-by-category">
        <Layout>
            <PageTitle
                icon="fa fa-folder-o"
                :main="category.name"
                sub="Categoria"
            />
            <ul>
                <li v-for="article in articles" :key="article.id">
                    <ArticleItem :article="article" />
                </li>
            </ul>
        </Layout>
    </div>
</template>

<script>
import Layout from "@/layouts/Layout.vue";
import PageTitle from "@/layouts/PageTitle.vue";
import ArticleItem from "./ArticleItem.vue";

export default {
    components: { Layout, PageTitle, ArticleItem },
    props: { category: Object, articles: Array },
};
</script>

<style>
.articles-by-category ul {
    list-style-type: none;
    padding: 0;
}

.articles-by-category .load-more {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 25px;
}
</style>
