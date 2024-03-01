<div>
    <label>{{ isset($label) ?$label: 'input' }}</label>
    <input name="{{ isset($name) ?$name: 'name' }}" type="{{ isset($type) ?$type: 'text' }}">
</div>
