<?PHP

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    protected $fillable = [
        'user_id',
        'dokument_id',
        'name'
    ];
}

?>