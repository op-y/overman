{* Smarty *}

<div class="container app-container-gap">
    {foreach $app123 as $app123_item }
    <div class="panel panel-primary">
        <div class="panel-heading"><strong class="app-title">{$app123_item.type}</strong></div>
        <div class="panel-body">
    
            <div class="row">
                {foreach $app123_item.items as $item }
                <div class="col-md-3" style="text-overflow:ellipsis;">
                    <div class="media">
                        {if isset($item.icon)}
                        <a class="pull-left" href="#"><img class="media-object" src="/application/views/image/{$item.icon}" style="width:32px;height:32px;"></a>
                        {else}
                        <a class="pull-left" href="#"><img class="media-object" src="/application/views/image/{$app123_item.icon}" style="width:32px;height:32px;"></a>
                        {/if}
                        <div class="media-body app-item">
                            <a target="_blank" href="{$item.link}">{$item.name}</a>
                        </div>
                    </div>
                </div>
                {if 3 == $item@index%4 || $item@last}
                </div>
                <br />
                <div class="row">
                {/if}
                {/foreach}
            </div>
    
        </div>
    </div>
    {/foreach}
</div>
