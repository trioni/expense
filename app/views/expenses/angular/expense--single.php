<div class="list-group-item expense" ng-repeat="item in list.items" ng-controller="ListItemCtrl">
    <div class="expense__frame" ng-class="actionState">
        <div class="expense__container" ng-class="actionState">
            <div class="expense__body">
                <p class="expense__owner">[[ item.owner ]]
                    <span class="label [[ item.type | typeClass ]] type">[[ item.type ]]</span>
                    <span class="timestamp">[[ item.date ]]</span>
                </p>
                <a class="expense__title" href="/expenses/filter?title=[[ item.title ]]">[[ item.title ]]</a>
                <span class="amount">[[ item.expense ]] hkd</span>
            </div>
            <div class="actions">
                <button class="actions__toggle" ng-click="toggleActions()"><span></span></button>
                <a href="[[ urlTo('edit', item.id) ]]" ng-click="clickHandler()" class="btn btn-default">Edit</a>

                <form class="delete-form" action="[[ urlTo('delete', item.id) ]]" method="POST" accept-charset="UTF-8">
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="_token" type="hidden" value="[[ CSRF_TOKEN ]]">
                    <input class="btn btn-warning" type="submit" value="Ta bort">
                </form>
            </div>
        </div>
    </div>
</div>
