<div v-for="team in teamsSelected">
    <a :href="'{{route('team', '')}}/' + team.slug">
            {% team.name %}
    </a>
</div>