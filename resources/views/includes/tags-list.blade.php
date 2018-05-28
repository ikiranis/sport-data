<div v-for="tag in tags">
    <a :href="'{{route('team', '')}}/' + tag.slug">
        {% tag.name %}
    </a>
</div>