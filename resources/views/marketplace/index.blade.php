@extends('layouts.app')

@section('content')

    <section id="header">

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h1>Titan Marketplace</h1>
                    <div class="float-right">
                        <div id="stats"></div>
                    </div>
                    <p>For all your free and paid extensions</p>

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-3 ais-SearchBox" id="searchbox">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="hits" class="row"></div>
            <div class="row">
                <div class="col-12 justify-content-center">
                    <div id="pagination"></div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@3.32.0/dist/algoliasearchLite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@^4.0.0"></script>

    <script>
        /* global instantsearch algoliasearch */

        const search = instantsearch({
            indexName: 'extensions',
            searchClient: algoliasearch('{{ env('ALGOLIA_APP_ID') }}', '{{ env('ALGOLIA_SEARCH_API') }}'),
        });

        let configuration = instantsearch.widgets.configure({
            hitsPerPage: 4,
        });

        const renderHits = (renderOptions, isFirstRender) => {
            const {hits, widgetParams} = renderOptions;

            widgetParams.container.innerHTML = `
      ${hits.map(item =>
                `
    <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h3>${instantsearch.highlight({attribute: 'name', hit: item})}</h3>
                    <div class="card-body">
                        <p>${instantsearch.highlight({attribute: 'description', hit: item, limit: 50})}</p>
                    </div>
                </div>
            </div>
    </div>`
            )
                .join('')}
  `;
        };

        // Create the custom widget
        const customHits = instantsearch.connectors.connectHits(renderHits);

        const renderSearchBox = (renderOptions, isFirstRender) => {
            const {query, refine, clear, isSearchStalled, widgetParams} = renderOptions;

            if (isFirstRender) {
                const input = document.createElement('input');

                input.addEventListener('input', event => {
                    refine(event.target.value);
                });

                input.classList.add('form-control');
                input.setAttribute('placeholder', 'Search through our library of extensions...');


                widgetParams.container.appendChild(input);

                let clearButton = document.createElement('div');

                clearButton.classList.add('input-group-append');
                clearButton.innerHTML =

                    `<div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="clearSearch"><i class="fas fa-times-circle"></i> </button>
                        </div>`;

                widgetParams.container.appendChild(clearButton)

                document.getElementById('clearSearch').addEventListener('click', () => {
                    clear();
                });

            }

            widgetParams.container.querySelector('input').value = query;
        };

        // create custom widget
        const customSearchBox = instantsearch.connectors.connectSearchBox(
            renderSearchBox
        );


        const renderStats = (renderOptions, isFirstRender) => {
            const { nbHits, processingTimeMS, query, widgetParams } = renderOptions;

            if (isFirstRender) {
                return;
            }

            let count = '';
            if (nbHits > 1) {
                count += `${nbHits} results`;
            } else if (nbHits === 1) {
                count += `1 result`;
            } else {
                count += `No result`;
            }

            widgetParams.container.innerHTML = `
    ${count} found
    ${query ? `for <q>${query}</q>` : ''}
  `;
        };

        // Create the custom widget
        const customStats = instantsearch.connectors.connectStats(renderStats);

        // instantiate custom widget
        search.addWidgets([
            customSearchBox({
                placeholder: 'Search through our extensions...',
                container: document.querySelector('#searchbox'),
            }),

            instantsearch.widgets.pagination({
                container: '#pagination',
            }),

            customHits({
                container: document.querySelector('#hits'),
            }),
            configuration,

            customStats({
                container: document.querySelector('#stats'),
            })
        ]);


        search.start();

    </script>
@endsection
