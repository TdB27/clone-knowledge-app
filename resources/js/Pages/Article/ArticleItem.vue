<template>
    <div class="article-item">
        <Link :href="route('article.get-by-article', [article.id])">
            <div class="article-item-image d-none d-sm-block">
                <img
                    v-if="article.img_url"
                    :src="article.img_url"
                    height="150"
                    width="150"
                    alt="Article"
                />
                <img
                    v-else
                    src="../../../assets/article.png"
                    height="150"
                    width="150"
                    alt="Article"
                />
            </div>
            <div class="article-item-info">
                <h2>{{ article.name }}</h2>
                <p>{{ article.description }}</p>
                <div class="article-item-author">
                    <strong>Autor: </strong> {{ article.user.name }}
                </div>
            </div>
        </Link>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    name: "ArticleItem",
    components: { Link },
    props: ["article"],
};
</script>

<style>
.article-item {
    border-radius: 8px;
    margin-bottom: 20px;
    background-color: #fff;
    padding: 20px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
}

.article-item a {
    display: flex;
    align-items: flex-start;
    text-decoration: none;
    color: #000;
}

.article-item-info h2 {
    font-size: 1.7rem;
}

.article-item-image {
    padding-right: 20px;
    margin-right: 20px;
    border-right: 1px solid #aaa;
}

.article-item-image img {
    border-radius: 5px;
}

.article-item-info {
    display: flex;
    align-self: stretch;
    flex-direction: column;
}
.article-item-info p {
    flex: 1;
    color: #555;
    font-size: 1.1rem;
}
</style>
