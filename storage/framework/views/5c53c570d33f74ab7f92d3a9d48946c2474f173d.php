<?php $__env->startSection('content'); ?>
    <?php if($message): ?>
        <div class="alert alert-info"><?php echo e($message); ?></div>
    <?php endif; ?>
    <p>
        <a href="<?php echo e(route('categories.browse')); ?>" class="btn btn-default">Browse Categories</a>
        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-success">Create Category</a>
    </p>
    <form method="get" onsubmit="return false;">
        <?php echo e(Form::label('search', 'Category name: ')); ?> <input type="text" name="keyword" id="keyword" onkeyup="updateResults();" /> <span id="keyword-status"></span>
    </form>

    <div id="search-results"></div>

    <script type="text/javascript">
        var defaultText = 'Type something to search';
        var resultsCache = {};
        var lastTyped = '';

        $('#keyword-status').text(defaultText);

        var popular = [];
        <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        popular.push({
            id: '<?php echo e($category->id); ?>',
            name: '<?php echo e($category->name); ?>',
            enabled: <?php echo e($category->enable ? 'true' : 'false'); ?>

        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

        var timer0 = null;
        function renderResults(results) {
            var $results = $('#search-results');
            $results.empty();
            var $keywordStatus = $('#keyword-status');
            $keywordStatus.text('Results: ' + results.length);
            var $table = $('<table />').addClass('table');
            for(var i=0, j=results.length; i < j; i++) {
                var $link = $('<a />').attr('href', '/categories/browse?category=' + results[i].id);
                if (results[i].enable === false) $link.attr('style', 'text-decoration: line-through');
                $link.text(results[i].name);

                $table.append(
                    $('<tbody />').append(
                        $('<tr />').append(
                            $('<td />').append($link)
                        )
                    )
                );
            }
            $results.append($table);
        }

        function updateResults() {

            if (timer0) clearTimeout(timer0);
            var $keywordStatus = $('#keyword-status');
            var $results = $('#search-results');

            var keyword = $('#keyword').val();
            if (keyword.length == 0) {
                $keywordStatus.text(defaultText);
                renderResults(popular);
            } else {
                if (keyword == lastTyped) return;

                $keywordStatus.text('Typing...');
                $results.empty();
                timer0 = setTimeout(function () {
                    $keywordStatus.text('Retrieving results...');
                    $.get({
                        url: '/categories/autocomplete',
                        data: { q: keyword },
                        success: function(results) {
                            if (results.length > 0) {
                                renderResults(results);
                            } else {
                                $keywordStatus.text('No results');
                            }
                            lastTyped = keyword;
                        },
                        error: function(err) {
                            console.log('Error');
                        }
                    });
                }, 600);
            }
        }

        renderResults(popular);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>