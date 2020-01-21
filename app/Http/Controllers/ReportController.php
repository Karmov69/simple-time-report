<?php
/**
 * MyClass File Doc Comment
 * php version 7.2
 *
 * @category MyClass
 * @package  MyPackage
 * @author   Pugofka <info@pugofka.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Role;
use App\User;
use App\Role as RoleConst;


/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @package  MyPackage
 * @author   Pugofka <info@pugofka.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.hashbangcode.com/
 */
class ReportController extends Controller
{
    protected $dateFormat = 'U';

    /**
     * Page for reports list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reports = Report::query()
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reports.index', compact('reports'));
    }

    /**
     * All list users for Admin
     *
     * @param Request $request The comment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all(Request $request)
    {
        $onlyUsers = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', RoleConst::ROLE_USER);
            }
        )->get();

        $reports = Report::query()
            ->orderBy('created_at', 'desc')
            ->get();

        if ($request->user) {
            $userId = $request->user ?? 'all';
            if ($userId !== 'all') {
                $reports = Report::query()
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
        }

        return view('reports.all', compact('reports', 'onlyUsers'));
    }

    /**
     * Editing report for user
     *
     * @param int $id Single report id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);

        return view('reports.edit', compact('report'));
    }

    /**
     * Updating report for user
     *
     * @param Request $request Request for update single report
     * @param Report  $report  Model Report
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Report $report)
    {
        $this->validate(
            $request, [
                'plane_hours' => 'required|numeric',
                'effective_hours' => 'required|numeric',
                'fact_hours' => 'required|numeric|gte:week_hours',
                'week_hours' => 'required|numeric|gte:effective_hours',
            ],
            [
                '*.required' => "Заполните объязательные поля",
                'fact_hours.gte'
                    => 'Фактическое рабочее время должно превышать рабочие часы.',
                'week_hours.gte'
                    => 'Рабочие часы должны превышать эффективные часы.'
            ]
        );

        $report->plane_hours = $request->input('plane_hours');
        $report->fact_hours = $request->input('fact_hours');
        $report->week_hours = $request->input('week_hours');
        $report->effective_hours = $request->input('effective_hours');
        $report->save();

        return redirect(route('reports.index'))
            ->with('status', 'Отчет успешно обновлен');
    }
}
