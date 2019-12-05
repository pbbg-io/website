@extends('layouts.app')

@section('content')

    <section id="marketplace">
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
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <h5>Rating</h5>
                    <div id="rating-menu"></div>
                </div>
                <div class="col-sm-12 col-md-9 justify-content-center">

                    <div id="hits" class="row"></div>
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
      ${hits.map(item => {

                    let stars = '';

                    item.rating = Math.floor(item.rating);

                    if (item.rating > 0)
                        for (let i = 0; i < item.rating; i++) {
                            stars = `${stars} <i class="fas fa-star text-primary"></i>`;
                        }
                    else
                        stars = '';


                    return `
    <div class="col-12">
            <div class="card mb-3">
            <a href="{{ url('/') }}/marketplace/${item.slug}/" class="position-absolute w-100 h-100"></a>
                <div class="card-header">
                    <h3 class="m-0">${instantsearch.highlight({attribute: 'name', hit: item})} <span class='float-right'>${stars}</span></h3>
                </div>
                    <div class="card-body">
                    <p>${item._snippetResult.description.value}</p>
                    </div>
            </div>
    </div>`
                }
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
            const {nbHits, processingTimeMS, query, widgetParams} = renderOptions;

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

        const renderRatingMenu = (renderOptions, isFirstRender) => {
            const { items, refine, createURL, widgetParams } = renderOptions;

            let ul = document.createElement('ul');

            if (isFirstRender) {
                ul.classList.add('list-unstyled');
                widgetParams.container.appendChild(ul);

                return;
            }

            widgetParams.container.querySelector('ul').innerHTML = items
                .map(
                    item => {

                        if(item.count > 0)
                        return `<li>
                          <a
                            class="${item.isRefined ? 'refined' : ''}"
                            href="${createURL(item.value)}"
                            data-value="${item.value}"
                            style="font-weight: ${item.isRefined ? 'bold' : ''}"
                          >
                            ${item.stars.map(isFilled => (isFilled ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>')).join('')}
                            <span class="float-right badge badge-secondary">${item.count}</span>
                          </a>
                        </li>`
                    }
                )
                .join('');

            [...widgetParams.container.querySelectorAll('a')].forEach(element => {
                element.addEventListener('click', event => {
                    event.preventDefault();
                    refine(event.currentTarget.dataset.value);
                });
            });
        };

        // Create the custom widget
        const customRatingMenu = instantsearch.connectors.connectRatingMenu(
            renderRatingMenu
        );

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
            }),
            customRatingMenu({
                container: document.querySelector('#rating-menu'),
                attribute: 'rating',
            })
        ]);


        search.start();

    </script>
@endsection
