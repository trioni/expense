<?php

View::composer('expenses.*', 'Expense\TitleComposer');
View::composer('sessions.*', 'Expense\TitleComposer');
View::composer('expenses.*', 'Expense\SummaryComposer');

