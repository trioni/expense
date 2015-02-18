<div class="list-group-item expense" ng-repeat="item in list.items | orderBy:predicate" ng-controller="ListItemCtrl">
    <div class="expense__frame [[item|excludedClass]]" ng-class="actionState">
        <div class="expense__container" ng-class="actionState">
            <div class="expense__body">
                <p class="expense__owner">[[ item.owner ]]
                    <span class="label [[ item.type | typeClass ]] type">
                        <a href="[[ item | urlTo:'type' ]]">[[ item.type ]]</a>
                    </span>
                    <span class="timestamp">[[ item.date ]]</span>
                    <a href="[[ item | urlTo:'excluded' ]]" ng-hide="item.include" class="expense--excluded">Exkluderad</a>
                </p>
                <a class="expense__title" href="[[ item | urlTo:'title' ]]">[[ item.title ]]</a>
                <span class="amount">[[ item.expense ]] hkd</span>
            </div>
            <div class="actions">
                <button class="actions__toggle" ng-click="toggleActions()"><span></span></button>
                <a href="[[ item | urlTo:'edit' ]]" class="btn btn-default">Edit</a>
                <a href="" ng-click="delete( item ); $event.stopPropagation();" class="btn btn-warning">Delete</a>
            </div>
        </div>
    </div>
</div>
