<div class="row" v-for="team in teamsSelected">
    <a :href="'{{route('team', '')}}/' + team.slug">
        <span class="my-1 mx-2 px-2 bg-secondary text-light">
            {% team.name %}
        </span>
    </a>
</div>