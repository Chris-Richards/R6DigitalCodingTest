import { useEffect, useState } from 'react';
import { Head } from '@inertiajs/react';

export default function Forecast(props) {

	useEffect(() => {

    }, []);

	return (
		// <div>Avg {(props.props.max_temp + props.props.min_temp / 2).toFixed(1)}&#8451; | Max {props.props.max_temp}&#8451; | Min {props.props.min_temp}&#8451;</div>

		<div className="grid grid-cols-4 text-center">
			<div>
				<span>Day {props.day}</span>
			</div>
			<div>
				<span>Avg {(props.props.max_temp + props.props.min_temp / 2).toFixed(1)}&#8451;</span>
			</div>
			<div>
				<span>Max {props.props.max_temp.toFixed(1)}&#8451;</span>
			</div>
			<div>
				<span>Low {props.props.min_temp.toFixed(1)}&#8451;</span>
			</div>
		</div>		
	)

}