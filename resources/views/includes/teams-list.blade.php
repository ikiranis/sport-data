<div class="row" v-for="team in teamsSelected">
    <a :href="'{{route('teamPosts', '')}}/' + team.slug">
        <span class="my-1 mx-2 px-2 bg-primary text-light">
            {% team.name %}
        </span>
    </a>
</div>