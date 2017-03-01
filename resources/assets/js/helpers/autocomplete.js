import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

var index = algolia('YXQC388RAD', 'db0dde892a2988764312663e15da07dd')

export const userautocomplete = selector => {
    var users = index.initIndex('users')

    return autocomplete(selector, {}, {
        source: autocomplete.sources.hits(users, { hitsPerPage: 10 }),
        displayKey: 'name',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion.name + '</span>'
            },
            empty: '<div class="aa-empty">No people found.</div>'
        }
    })
}
