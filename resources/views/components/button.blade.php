<button {{$attributes->merge(['class'=>'btn black-text waves-effect transparent'])}} {{$attributes}} x-data @click="$(event.target).html(aem.spinner()).prop('disabled',true)">
    {{$slot}}
</button>
