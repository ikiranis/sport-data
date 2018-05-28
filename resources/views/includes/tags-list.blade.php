<div v-for="tag in tags">
    <a :href="'{{route('tag', '')}}/' + tag.slug">
        {% tag.name %}
    </a>
</div>