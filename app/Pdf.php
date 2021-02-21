<?PHP

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    protected $fillable = [
        'name',
        'dokument_id',
        'user_id',
        'anzahlGruppen' 
    ];

    public function dokument(){
        return $this->belongsTo('App\Dokument');
    }
}

?>