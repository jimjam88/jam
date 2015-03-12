{{ partial('partials/nav') }}

<section class="content">
    <h1>API &raquo; /details</h1>
    <p>This request returns the contact details for the company including the social media links.</p>
    <h4>Live Response:</h4>
    <pre id="editor">{{ details }}</pre>
</section>
<script type="text/javascript" src="/js/ace/ace.js" charset="utf-8"></script>
<script>
    var editor = ace.edit('editor');
    editor.setReadOnly(true);
    editor.setTheme('ace/theme/monokai');
    editor.getSession().setMode('ace/mode/json');
</script>