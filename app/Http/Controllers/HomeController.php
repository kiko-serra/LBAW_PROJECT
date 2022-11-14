<!--

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Card;

class CardController extends Controller
{
    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $card = Card::find($id);
      $this->authorize('show', $card);
      return view('pages.card', ['card' => $card]);
    }
} -->