BX.ready(function() {
    /*
    1. Спомощью document.querySelectorAll получить все DOM-элементы с классом star
    2. Повесить обработчик события на click
    Пример: BX.bind(element, "click", clickStar);
     */

    const AllStarElems = document.querySelectorAll(".star")
    AllStarElems.forEach((elem) => {
        // elem.addEventListener('click', (event) => {
        //     const {target} = event
            // console.log("BXReady", target.parentNode)

        //     BX.bind(target, 'click', clickStar)
        // })

        BX.bind(elem, 'click', clickStar)
    })
});

function clickStar(event) {
    event.preventDefault();
    const {target} = event;
    /*
    Получить agentID, в template.php добавьте тегу в классов star атрибут dataset
    cо значением ID элемента Агента
    (https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/dataset)
     */

    const agentID = target.parentNode.dataset.id;
    // console.log("CStar", target.parentNode.dataset.id)

    if (agentID) { // если ID есть, то делаем ajax-запрос
        BX.ajax // https://dev.1c-bitrix.ru/api_help/js_lib/ajax/bx_ajax_runcomponentaction.php
            .runComponentAction(
                "mcart:agents.list", // название компонента
                "clickStar", // название метода, который будет вызван из class.php
                {
                    mode: "class", //это означает, что мы хотим вызывать действие из class.php
                    data: {
                        agentID: agentID // параметры, которые передаются на бэк
                    },
                }
            )
            .then( // если на бэке нет ошибок
                BX.proxy((response) => {
                    console.log(response); // консоле можно будет увидеть ответ от бэка, в конечном коде лучше убрать
                    let data = response.data;
                    if (data['action'] == 'success') {
                        target.parentNode.classList.toggle('active');
                    }

                }, this)
            )
            .catch( // если на бэке есть ошибки
                BX.proxy((response) => {
                    console.log(response.errors);
                }, this)
            );
    }

}
