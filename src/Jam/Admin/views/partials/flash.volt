{% if flashSession.has('error') %}
<div class="alert alert-danger">
    <b class="icon-warning"></b>
    {{ flashSession.output() }}
</div>
{% endif %}

{% if flashSession.has('success') %}
<div class="alert alert-success">
    <b class="icon-info"></b>
    {{ flashSession.output() }}
</div>
{% endif %}

{% if flashSession.has('info') %}
<div class="alert alert-info">
    <b class="icon-info"></b>
    {{ flashSession.output() }}
</div>
{% endif %}