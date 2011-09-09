{ifuserconnected}
 
 <form action="{formurl 'jediCounter~save:index'}" method="POST" class="jedicounter">
    <div>
        {formurlparam}
        <input type="hidden" name="action_to_return" value="{$action_to_return}"/>
        <input type="hidden" name="subject_id" value="{$subject_id}"/>
        <input type="hidden" name="scope" value="{$scope}"/>
        
        <button id="jedicounter-{$subject_id}-{$scope}" type="submit"><span>{$text}</span></button>
    
    </div>
 </form>
 
{/ifuserconnected}