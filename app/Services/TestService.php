<?php

namespace App\Services;

use App\Models\Test;

class TestService
{
    public function all() {
        $tests = Test::with('manager');

        if(auth()->user()->role == 'manager') {
            $tests = $tests->where('manager_id', auth()->user()->id);
        }

        return $tests->get();
    }

    public function create($data) {
        $data['criterion'] = $this->getCriterion($data['grade']);

        return Test::create($data);
    }

    public function destroy($id) {
        return Test::destroy($id);
    }

    public function get($id) {
        return Test::find($id);
    }

    public function update($data, $id) {
        return Test::where('id', $id)->update($data);
    }

    public function getCriterion($grade) {
        if ($grade >= 100) {
            return 500;
        } else if ($grade >= 91) {
            return 300;
        } elseif ($grade >= 80) {
            return 200;
        } elseif ($grade >= 60) {
            return 100;
        } else {
            return 0;
        }
    }
}
