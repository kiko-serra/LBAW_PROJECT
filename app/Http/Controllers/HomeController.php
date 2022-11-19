<!--

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class CardController extends Controller
{
    /**
     * Shows the post for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      $this->authorize('show', $post);
      return view('pages.post', ['post' => $post]);
    }
} -->