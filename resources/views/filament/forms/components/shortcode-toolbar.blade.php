<div class="flex flex-wrap items-center gap-1 rtl:space-x-reverse focus:outline-none">
    @foreach ($getShortCodes() as $shortCodeLabel => $shortCode)
        <x-forms::rich-editor.toolbar-button
            x-on:click="
                if (!activeShortcodeElement) {
                    return;
                }

                if (activeShortcodeElement.editor) {
                    let value = '{{ ($insertShortCodesAsHtml() ? $shortCode . '&nbsp;' : strip_tags($shortCode) . ' ') }}'
                    activeShortcodeElement.editor.insertHTML(value);
                } else {
                    activeShortcodeElement.value += '{{ strip_tags($shortCode) }}'
                    activeShortcodeElement.focus();
                }
            "
            tabindex="-1"
        >
            {{ $shortCodeLabel }}
        </x-forms::rich-editor.toolbar-button>
    @endforeach
</div>
