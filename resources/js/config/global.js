export function categoriesWithPath(categories) {
    const getParent = (categories, parentId) => {
        const parent = categories.filter((parent) => parent.id === parentId);
        return parent.length ? parent[0] : null;
    };

    const categoriesWithPath = categories.map((category) => {
        let path = category.name;
        let parent = getParent(categories, category.parent_id);

        while (parent) {
            path = `${parent.name} > ${path}`;
            parent = getParent(categories, parent.parent_id);
        }

        return { ...category, path };
    });

    categoriesWithPath.sort((a, b) => {
        if (a.path < b.path) return -1;
        if (a.path > b.path) return 1;
        return 0;
    });

    return categoriesWithPath;
}

export default { categoriesWithPath };
