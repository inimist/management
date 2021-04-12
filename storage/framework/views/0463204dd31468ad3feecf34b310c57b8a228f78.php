<?php $__env->startSection('content'); ?>

    <h1><?php echo e($account->name); ?></h1>

    <p>
        <a href="<?php echo e(route('accounts.homefeed', ['id' => $account->id])); ?>" class="btn btn-default">View Home Feed</a>
        <a href="<?php echo e(route('accounts.photo', ['id' => $account->id])); ?>" class="btn btn-default">Update photo</a>
    </p>
    <?php if(isset($account->stats)): ?>
        <table class="table">
            <?php if(isset($account->stats->numPosts)): ?>
            <tr>
                <th><a href="<?php echo e(route('accounts.posts', ['id' => $account->id])); ?>"># Posts</a></th>
                <td><?php echo e(number_format($account->stats->numPosts)); ?></td>
            </tr>
            <?php endif; ?>
            
            
                
                
            
            
            <?php if(isset($account->stats->numFollowing)): ?>
            <tr>
                <th><a href="<?php echo e(route('accounts.following', ['id' => $account->id])); ?>"># Following</a></th>
                <td><?php echo e(number_format($account->stats->numFollowing)); ?></td>
            </tr>
            <?php endif; ?>
            <?php if(isset($account->stats->numFollowers)): ?>
            <tr>
                <th><a href="<?php echo e(route('accounts.followers', ['id' => $account->id])); ?>"># Followers</a></th>
                <td><?php echo e(number_format($account->stats->numFollowers)); ?></td>
            </tr>
            <?php endif; ?>
            
            
                
                
            
            
            
                
                    
                    
                
            
        </table>

        <h2>User Info</h2>
        <table class="table">
            <?php if(isset($account->email)): ?>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($account->email); ?></td>
                </tr>
            <?php endif; ?>
            <?php if(isset($account->created)): ?>
                <tr>
                    <th>Created</th>
                    <td><?php echo e(date("Y-m-d", $account->created)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if(isset($account->providers) && $account->providers): ?>
                <tr>
                    <th>Providers</th>
                    <td><?php echo e(join(', ', $account->providers)); ?></td>
                </tr>
            <?php endif; ?>
            <?php if(isset($account->accountType) && $account->accountType): ?>
                <tr>
                    <th>Account Type</th>
                    <td><?php echo e($account->accountType); ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <h2>Badges</h2>

        <div id="badges">
            
                
            
        </div>

        <script type="text/javascript">
            <?php 
                echo 'var availableBadges = ' . json_encode($available_badges) . ';';
                echo 'var inBadges = ' . json_encode($account->badges) . ';';
             ?>
            <?php $__currentLoopData = $available_badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

            function hasBadge(badge) {
                return (inBadges.filter(function(inBadge) { return inBadge.key == badge.key }).length > 0);
            }
            function toggleBadge(obj) {
                var $obj = $(obj);

            }

            var addUrl = '<?php echo e(route('accounts.addBadge', ['id' => $account->id ])); ?>';
            var removeUrl = '<?php echo e(route('accounts.removeBadge', ['id' => $account->id ])); ?>';
            function renderBadges() {
                var $badges = $('#badges');
                $badges.empty();
                for(var i=0, j=availableBadges.length; i < j; i++) {
                    var inBadge = hasBadge(availableBadges[i]);
                    $chk = $('<input />').attr({type: 'checkbox', value: availableBadges[i].key});

                    if (inBadge) $chk.attr('checked', true);
                    $chk.change(function(ev) {
                        var $this = $(this);
                        var $status = $('<span />').text(' ...').css('font-weight', 'normal').appendTo($this.parent());
                        var isChecked = $(this).is(':checked');
                        var url = isChecked ? addUrl : removeUrl;
                        $.post(url, {
                                badge: $(this).val(),
                                _token: '<?php echo e(csrf_token()); ?>',
                            },
                            function(data, status) {
                                $this.attr('disabled', false);
                                $status.text(' (updated)');
                                window.location.reload(false); 
                                //setTimeout(function() { $status.remove(); }, 2000);
                            },
                            'json'
                        );
                    });
                    $label = $('<label />').text(' ' + availableBadges[i].name).prepend($chk);
                    $badges.append($label, $('<br />'));
                }
            }
            renderBadges();
        </script>

        <hr />

        <div class="advanced-options">
            <p><a href="#" onclick="$('.advanced-options').toggle();return false;">Show Advanced Options</a></p>
        </div>
        <div class="advanced-options init-hidden">
            <p><a href="#" onclick="$('.advanced-options').toggle();return false;">Hide Advanced Options</a></p>
            <?php echo e(Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete', 'onclick' => 'return confirm(\'Are you sure you want to delete this user and their posts?\');'])); ?>

            <input type="submit" value="Delete User" class="btn btn-danger" />
            <?php echo e(Form::close()); ?>

        </div>
    <?php else: ?>
        No stats available
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>